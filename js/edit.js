$(document).ready(() => {
    let state = false;
    let stateDel = false;
    let stateEdit = false;
    $('.edit_button').on('click', (e) => {
        e.preventDefault();
        if (state == false) {
            $('.edit__options').css('visibility', 'visible');
            state = true;
        } else {
            $('.edit__options').css('visibility', 'hidden');
            state = false;
        }
    });
    $('.option--delete').on('click', (e) => {
        e.preventDefault();
        if (stateDel == false) {
            $('.form--delete').css('display', 'inherit');
            stateDel = true;
        } else {
            $('.form--delete').css('display', 'none');
            stateDel = false;
        }
    });
    $('.option--edit').on('click', (e) => {
        e.preventDefault();
        if (stateEdit == false) {
            $('.form--edit').css('display', 'inherit');
            stateEdit = true;
        } else {
            $('.form--edit').css('display', 'none');
            stateEdit = false;
        }
    });
});