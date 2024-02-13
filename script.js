const validateForm = document.querySelector("#validate-btn");

validateForm.addEventListener('click', (e) => {
    e.preventDefault()
    alertForm();
})



function alertForm(){
    const inputName = document.querySelector("#name").value;
    const inputFirstname = document.querySelector("#firstname").value;
    const inputEmail = document.querySelector("#email").value;
    const inputPicture = document.querySelector("#upload");
    const inputDescription = document.querySelector("#desc").value;

    if (inputName.length < 2 || inputName.length > 255) {
        document.getElementById("nameError").textContent = "Must be between 2 and 255 characters long";
    } else {
        document.getElementById("nameError").textContent = "";
    }

    if (inputFirstname.length < 2 || inputFirstname.length > 255) {
        document.getElementById("firstnameError").textContent = "Must be between 2 and 255 characters long";
    } else {
        document.getElementById("firstnameError").textContent = "";
    }

    if (inputEmail.length < 2 || inputEmail.length > 255) {
        document.getElementById("emailError").textContent = "Must be between 2 and 255 characters long";
    } else {
        document.getElementById("emailError").textContent = "";
    }

    if (inputDescription.length < 2 || inputDescription.length > 1000) {
        document.getElementById("descError").textContent = "Must be between 2 and 1000 characters long";
    } else {
        document.getElementById("descError").textContent = "";
    }

    if (inputPicture.files.length > 0) {
        const fileSize = inputPicture.files[0].size;
        const maxSize = 2 * 1024 * 1024; // 2 Mo
        if (fileSize > maxSize) {
            document.getElementById("uploadError").textContent = "Picture size must be less than 2 MB";
        } else {
            document.getElementById("uploadError").textContent = "";
        }
    }

    return true;
}