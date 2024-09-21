<div>
    <div wire:ignore x-data="{ content: @entangle($attributes->wire('model')) }" x-init="
        ClassicEditor
            .create($refs.editor)
            .then(editor => {
                // Si hay contenido, cargarlo en CKEditor
                if (content) {
                    editor.setData(content);
                }
                
                // Escuchar cambios en CKEditor y actualizar la propiedad 'content'
                editor.model.document.on('change:data', () => {
                    content = editor.getData(); // Actualiza 'content' que está vinculado a 'description'
                });
            })
            .catch(error => {
                console.error(error);
            });
    ">
        <textarea x-ref="editor"></textarea> <!-- Referencia al editor CKEditor -->
    </div>
</div>
