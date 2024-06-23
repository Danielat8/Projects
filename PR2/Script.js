$(document).ready(function () {
  // Function to load notes
  function loadNotes() {
    var bookId = $('#add-note-form input[name="book_id"]').val();
    $("#private-notes").load("load_private_notes.php", { book_id: bookId });
  }

  loadNotes();

  // adding private note
  $("#add-note-form").submit(function (e) {
    e.preventDefault();
    e.stopPropagation();
    // loadNotes();

    var noteText = $("#note-text").val();
    var bookId = $('#add-note-form input[name="book_id"]').val();

    $.ajax({
      type: "POST",
      url: "add_private_note.php",
      data: {
        note: noteText,
        book_id: bookId,
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          loadNotes();

          $("#note-text").val("");
        }
      },
      error: function (error) {
        console.log(error, "Error adding note:");
      },
    });
  });

  // deleting
  $("#private-notes").on("click", ".delete-note", function () {
    loadNotes();
    var noteId = $(this).data("note-id");

    $.ajax({
      type: "POST",
      url: "delete_private_note.php",
      data: {
        note_id: noteId,
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          // Reload the notes list
          loadNotes();
        }
      },
      error: function (error) {
        console.log(error, "Error deleting note:");
      },
    });
  });

  //  editing
  $("#private-notes").on("click", ".edit-note-btn", function () {
    var noteId = $(this).data("note-id");
    var currentNoteText = $("#note-" + noteId + " span")
      .text()
      .trim();

    $("#note-" + noteId).html(
      '<input type="text" class="form-control note-edit-input" value="' +
        currentNoteText +
        '"> <button class="btn btn-success btn-sm save-edit-btn" data-note-id="' +
        noteId +
        '">Save</button> <button class="btn btn-secondary btn-sm cancel-edit-btn" data-note-text="' +
        currentNoteText +
        '">Cancel</button>'
    );
  });

  // saving edited private note
  $("#private-notes").on("click", ".save-edit-btn", function () {
    var noteId = $(this).data("note-id");
    var newNoteText = $("#note-" + noteId + " input.note-edit-input").val();
    loadNotes();

    $.ajax({
      type: "POST",
      url: "edit_private_note.php",
      data: {
        note_id: noteId,
        new_note: newNoteText,
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          loadNotes();
        }
      },
      error: function (error) {
        console.log(error, "Error edditing note:");
      },
    });
  });

  // Cancel editing
  $("#private-notes").on("click", ".cancel-edit-btn", function () {
    loadNotes();
  });
});
