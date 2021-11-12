window.onload = function(){
    fetchLoginForm()
}

function fetchLoginForm() { 
    let container = document.querySelector(".container");
    fetch('http://localhost/info2180-project2/php/login-form.php')
    .then(response => {
        if(response.ok){
            return response.text();
        }
        else{
            throw new Error(`An error has occured: ${response.status}`);
        }
    })
    .then(data => {
        container.innerHTML = data;
    })
    .catch(err => {
        console.log(err);
    })
}