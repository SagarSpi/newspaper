$(document).ready(function () {
    const maxTags = 4;
    const tagsInput = $("#tags_input");
    const errorElement = $("#tags_error");

    tagsInput.on("itemAdded", function (event) {
        const tags = tagsInput.tagsinput("items");
        if (tags.length > maxTags) {
            errorElement.show();
            tagsInput.tagsinput("remove", event.item);
        } else {
            errorElement.hide();
        }
    });
});
