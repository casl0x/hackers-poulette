const validateForm = document.querySelector("#validate-btn");

validateForm.addEventListener('click', (e) => {
    e.preventDefault()
    alertForm();
})



function alertForm() {
    const inputName = document.querySelector("#name").value;
    const inputFirstname = document.querySelector("#firstname").value;
    const inputEmail = document.querySelector("#email").value;
    const inputPicture = document.querySelector("#upload");
    const inputDescription = document.querySelector("#desc").value;

    if (inputName.length < 2 || inputName.length > 255) {
        document.getElementById("nameError").classList.add("bg-orange-100 border-l-4 border-orange-500 text-orange-700 text-sm px-4 py-1 my-2");
        document.getElementById("nameError").textContent = "Must be between 2 and 255 characters long";
    } else {
        document.getElementById("nameError").style.display = "none";
    }

    if (inputFirstname.length < 2 || inputFirstname.length > 255) {
        document.getElementById("firstnameError").classList.add("bg-orange-100 border-l-4 border-orange-500 text-orange-700 text-sm px-4 py-1 my-2");
        document.getElementById("firstnameError").textContent = "Must be between 2 and 255 characters long";
    } else {
        document.getElementById("firstnameError").style.display = "none";
    }

    if (inputEmail.length < 2 || inputEmail.length > 255) {
        document.getElementById("emailError").classList.add("bg-orange-100 border-l-4 border-orange-500 text-orange-700 text-sm px-4 py-1 my-2");
        document.getElementById("emailError").textContent = "Must be between 2 and 255 characters long";
    } else {
        document.getElementById("emailError").style.display = "none";
    }

    if (inputDescription.length < 2 || inputDescription.length > 1000) {
        document.getElementById("descError").classList.add("bg-orange-100 border-l-4 border-orange-500 text-orange-700 text-sm px-4 py-1 my-2");
        document.getElementById("descError").textContent = "Must be between 2 and 1000 characters long";
    } else {
        document.getElementById("descError").style.display = "none";
    }

    if (inputPicture.files.length > 0) {
        const fileSize = inputPicture.files[0].size;
        const maxSize = 2 * 1024 * 1024; // 2 Mo
        if (fileSize > maxSize) {
            document.getElementById("uploadError").classList.add("bg-orange-100 border-l-4 border-orange-500 text-orange-700 text-sm px-4 py-1 my-2");
            document.getElementById("uploadError").textContent = "Picture size must be less than 2 MB";
        } else {
            document.getElementById("uploadError").style.display = "none";
        }
    }

    return true; // Tout est valide
}