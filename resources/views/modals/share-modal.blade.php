<div id="shareModal" class="hidden">
    <div class="modal">
        <div class="modal-content">
            <form action="" method="POST" id="shareForm">
                @csrf
                <p>{{ __('Share') }} <code id="shareName"></code> {{ __('with') }}?<p>
                <input type="text" name="email" required placeholder="{{ __('Email') }}" >
                <input id="shareId" type="hidden" name="file_id" value="">
                <button type="button" class="button secondary" onclick="closeModal()">{{ __('Cancel') }}</button>
                <button type="submit" class="button success">{{ __('Share') }}</button>
            </form>
        </div>
    </div>
</div>
