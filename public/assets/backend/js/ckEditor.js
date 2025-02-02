ClassicEditor.create(document.querySelector("#description"), {
    toolbar: [
        "heading",
        "|",
        "bold",
        "italic",
        "blockQuote",
        "|",
        "numberedList",
        "bulletedList",
        "outdent",
        "indent",
        "|",
        "link",
        "insertTable",
        "|",
        "undo",
        "redo",
    ],
})
    .then((editor) => {
        console.log("Editor was initialized", editor);
    })
    .catch((error) => {
        console.error("Error during initialization of the editor", error);
    });
