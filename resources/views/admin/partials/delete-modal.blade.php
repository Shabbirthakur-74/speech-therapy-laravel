{{-- Shared delete confirmation modal + toast. Trigger: any .icon-delete button
     carrying data-kind (patient|session), data-name and data-url.
     On success it fires a document-level "admin:deleted" event. --}}
<div class="modal" id="delete-modal" hidden role="dialog" aria-modal="true" aria-labelledby="delete-modal-title">
    <div class="modal__backdrop" data-close></div>
    <div class="modal__card">
        <div class="modal__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <h3 class="modal__title" id="delete-modal-title">Delete?</h3>
        <p class="modal__text" id="delete-modal-text"></p>
        <div class="modal__actions">
            <button type="button" class="btn btn--ghost" data-close>Cancel</button>
            <button type="button" class="btn btn--danger" id="delete-modal-confirm">Yes, delete</button>
        </div>
    </div>
</div>

<div class="toast" id="toast" role="status" aria-live="polite"></div>

<script>
    (function () {
        var modal = document.getElementById('delete-modal');
        var titleEl = document.getElementById('delete-modal-title');
        var textEl = document.getElementById('delete-modal-text');
        var confirmBtn = document.getElementById('delete-modal-confirm');
        var toastEl = document.getElementById('toast');
        var toastTimer = null;
        var pending = null;

        var copy = {
            patient: {
                title: 'Delete patient?',
                text: function (name) {
                    return 'This permanently deletes ' + name + ', their login history and all assessment sessions and results. This cannot be undone.';
                },
                done: 'Patient deleted successfully'
            },
            session: {
                title: 'Delete session?',
                text: function (name) {
                    return 'This permanently deletes ' + name + ' and its assessment results. This cannot be undone.';
                },
                done: 'Session deleted successfully'
            }
        };

        function showToast(message, type) {
            toastEl.textContent = message;
            toastEl.className = 'toast is-visible' + (type === 'error' ? ' toast--error' : '');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(function () {
                toastEl.classList.remove('is-visible');
            }, 3000);
        }

        function closeModal() {
            modal.hidden = true;
            confirmBtn.disabled = false;
            pending = null;
        }

        document.addEventListener('click', function (e) {
            var trigger = e.target.closest('.icon-delete');

            if (trigger) {
                pending = {
                    kind: trigger.dataset.kind,
                    name: trigger.dataset.name,
                    url: trigger.dataset.url,
                    id: trigger.dataset.id || null,
                    sessionId: trigger.dataset.session || null
                };
                titleEl.textContent = copy[pending.kind].title;
                textEl.textContent = copy[pending.kind].text(pending.name);
                modal.hidden = false;
                confirmBtn.focus();
                return;
            }

            if (e.target.closest('[data-close]')) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !modal.hidden) {
                closeModal();
            }
        });

        confirmBtn.addEventListener('click', function () {
            if (!pending) { return; }

            var item = pending;
            confirmBtn.disabled = true;

            fetch(item.url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(function (response) {
                if (!response.ok) { throw new Error('Request failed'); }
                return response.json();
            })
            .then(function () {
                closeModal();
                showToast(copy[item.kind].done, 'success');
                document.dispatchEvent(new CustomEvent('admin:deleted', { detail: item }));
            })
            .catch(function () {
                closeModal();
                showToast('Could not delete. Please try again.', 'error');
            });
        });
    })();
</script>
