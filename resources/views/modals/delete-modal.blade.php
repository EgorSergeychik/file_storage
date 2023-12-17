<div id="deleteModal" class="hidden">
    <div class="modal">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                @method('DELETE')

                <p>{{ __('Are you sure you want to delete the') }} <code id="deleteName"></code>?<p>

                    <button type="submit" class="danger-button">{{ __('Delete') }}</button>
                    <button type="button" onclick="closeModal()" class="primary-button">{{ __('Cancel') }}</button>
            </form>
        </div>
    </div>
</div>
