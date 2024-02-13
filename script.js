const validateForm = document.querySelector("#validate-btn");

validateForm.addEventListener('click', (e) => {
    e.preventDefault()
})



function alertForm(){
    const inputName = document.querySelector("#name").value;
    const inputFirstname = document.querySelector("#firstname").value;
    const inputEmail = document.querySelector("#email").value;
    const inputPicture = document.querySelector("#upload");
    const inputDescription = document.querySelector("#desc").value;

    if (inputName.length < 2 || inputName.length > 255){
        alert("Must be between 2 and 255 characters long");
        return false;
    }
    if (inputFirstname.length < 2 || inputFirstname.length > 255){
        alert("Must be between 2 and 255 characters long")
        return false;
    }
    if (inputEmail.length < 2 || inputEmail.length > 255){
        alert("Must be between 2 and 255 characters long")
        return false;
    }
    
    if (inputDescription.length < 2 || inputDescription.length > 1000){
        alert("Must be between 2 and 255 characters long")
        return false;
    }

    if (inputPicture.files.length > 0) {
        const fileSize = inputPicture.files[0].size;
        const maxSize = 5 * 1024 * 1024; // 5 Mo
        if (fileSize > maxSize) {
            alert("Picture size must be less than 5 MB");
            return false;
        }
    }

    return true;
}