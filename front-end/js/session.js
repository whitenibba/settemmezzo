let userid=-1;

async function checkSession(){
    const res = await postData(hostAddr+"/getProducts?logged=1");
    if(res.id == 1){
        return true;
    }
    else{
        return false;
    } 
}

async function sendLoginForm(){
    const u = document.getElementById("inputUser").value;
    const p = document.getElementById("inputPassword").value;
    let data = {"user" : u , "pass" : p};
    const res = await postData(hostAddr+"/login",data);
    if(res.id=="-1"){
        alert("Credenziali Errate");
    }else{
        window.location.reload();
        //userid=res.id;
        //getProducts();
        //hideLoginModal();
    }
}