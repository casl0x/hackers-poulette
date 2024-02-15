
function alertForm() {
    const inputName = document.querySelector("#name").value;
    const inputFirstname = document.querySelector("#firstname").value;
    const inputEmail = document.querySelector("#email").value;
    const inputPicture = document.querySelector("#file-upload");
    const inputDescription = document.querySelector("#desc").value;

    let value1;
    let value2;
    let value3;
    let value4;

    if (inputName.length < 2 || inputName.length > 255) {
        document.getElementById("nameError").innerHTML = "<p class='bg-orange-100 border-l-4 border-orange-500 text-orange-700 text-sm px-4 py-1 my-2'> Must be between 2 and 255 characters long </>";
        value1 = false;
    } else {
        document.getElementById("nameError").style.display = "none";
        value1 = true;
    }

    if (inputFirstname.length < 2 || inputFirstname.length > 255) {
        document.getElementById("firstnameError").innerHTML = "<p class='bg-orange-100 border-l-4 border-orange-500 text-orange-700 text-sm px-4 py-1 my-2'> Must be between 2 and 255 characters long </>";
        value2 = false;
    } else {
        document.getElementById("firstnameError").style.display = "none";
        value2 = true;
    }

    if (inputEmail.length < 2 || inputEmail.length > 255) {
        document.getElementById("emailError").innerHTML = "<p class='bg-orange-100 border-l-4 border-orange-500 text-orange-700 text-sm px-4 py-1 my-2'> Must be between 2 and 255 characters long </>";
        value3 = false;
    } else {
        document.getElementById("emailError").style.display = "none";
        value3 = true;
    }

    if (inputDescription.length < 2 || inputDescription.length > 1000) {
        document.getElementById("descError")
        document.getElementById("descError").innerHTML = "<p class='bg-orange-100 border-l-4 border-orange-500 text-orange-700 text-sm px-4 py-1 my-2'> Must be between 2 and 1000 characters long </>";
        value4 = false;
    } else {
        document.getElementById("descError").style.display = "none";
        value4 = true;
    }

    if (inputPicture.files.size > 0) {
        const fileSize = inputPicture.files[0].size;
        const maxSize = 2 * 1024 * 1024; // 2 Mo
        if (fileSize > maxSize) {
            document.getElementById("uploadError").innerHTML = "<p class='bg-orange-100 border-l-4 border-orange-500 text-orange-700 text-sm px-4 py-1 my-2'> Must be up to 2MB</>";
        } else {
            document.getElementById("uploadError").style.display = "none";
        }
    }
    if (value1 == false || value2 == false || value3 == false || value4 == false){
        return false; // Il y a un soucis
    }
    else{
        return true; // Tout est correcte
    }
   
}

window.onload = function(){
    document.getElementById("validate-btn").addEventListener('click', (e) => {
        let value = alertForm();
        if (value==false){
            e.preventDefault()
        }
    })
}
