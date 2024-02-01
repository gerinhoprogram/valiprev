<script src="<?= base_url('public/restrita/assets/js/tinymce/tinymce.min.js') ?>"></script>
<script> 
    const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '<?= base_url() ?>restrita/editor_texto/upload');

        xhr.upload.onprogress = (e) => {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = () => {
            if (xhr.status === 403) {
                reject({
                    message: 'HTTP Error: ' + xhr.status,
                    remove: true
                });
                return;
            }

            if (xhr.status < 200 || xhr.status >= 300) {
                reject('HTTP Error: ' + xhr.status);
                return;
            }

            const json = JSON.parse(xhr.responseText);

            console.log(xhr.status); 

            if (!json || typeof json.location != 'string') {
                reject('Invalid JSON: ' + xhr.responseText);
                return;
            }

            resolve(json.location);
        };

        xhr.onerror = () => {
            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };

        const formData = new FormData();

        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    });
    tinymce.init({
        selector: '.texto_editor',
        file_picker_types: 'file image media',
        height: 300,
        width: '100%',
        menubar: true,
        language: 'pt_BR',
        plugins: [
            'advlist autolink lists link charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime table paste code contextmenu',
            'wordcount', 'image', 'codesample', 
        ],
        toolbar: "undo redo format bold italic forecolor backcolor alignleft aligncenter alignright alignjustify bullist numlist outdent indent table link image anchor",
        imagetools_toolbar: "rotateleft rotateright | flipv fliph",
        paste_data_images: true,
        media_live_embeds: true,
        images_upload_credentials: true,
        entity_encoding : "raw", 
        allow_html_in_named_anchor: true, 
        images_upload_url:  '<?= base_url() ?>restrita/editor_texto/upload',
        images_upload_handler: example_image_upload_handler
    });
</script>
