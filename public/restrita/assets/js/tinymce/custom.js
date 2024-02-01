tinymce.init({
    selector: 'textarea',
    plugins: "image code jbimages imagetools advlist link table textcolor media",
    toolbar: "undo redo format bold italic forecolor backcolor alignleft aligncenter alignright alignjustify bullist numlist outdent indent table link media image jbimages",
    imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
    paste_data_images: true,
    media_live_embeds: true,
    relative_urls: false,
});