<div id="editModal" class="hidden">
    <div class="modal">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                @method('PUT')

                <input type="text" name="name" value="">
                <input type="hidden" name="folder_id" value="">

                <button type="submit" class="button success">Сохранить</button>
                <button type="button" onclick="closeModal()" class="button primary">Отмена</button>
            </form>
        </div>
    </div>
</div>
