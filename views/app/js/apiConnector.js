//------------GLOBAL VARIABLES---------------
//Errore -1 di Sessione
const err1="La sessione è scaduta o non hai eseguto l'accesso. Esci e rientra eseguendo l'accesso (per sicurezza prima di eseguire quest'operazione schiaccia sul pulsante di logout).";

//Errore -2 di query
const err2="Si è verificato un errore. Riprovare e se l'errore persiste effettuare il logout e rientrare. Se l'errore continua a persistere contattare il fornitore.";

//Errore -3 dati corrotti
const err3="I dati inviati sono andati persi. Per favore riprovare l'operazione. Se il problema si provi ad uscire e rientrare. Se l'errore continua a persistere contattare il fornitore.";


let shownProducts;
let page = 1;
let pages = 0;
let page_size = 3;
let userid=-1;
let category = -1;

//-------------------------------------------


//--------------------INITIALIZATION INSTRUCTIONS----------------------------

let searchInput;

window.addEventListener("DOMContentLoaded", (event) => {
    //-------------------QUANTITY MODAL---------------------
    document.getElementById("aggiungiButton").addEventListener("click",(event)=>{
        let q = parseInt(document.getElementById("qty-label-modal").innerHTML);
        let a = parseInt(document.getElementById("aggiungiInput").value);
        document.getElementById("qty-label-modal").innerHTML=a+q;
        document.getElementById("aggiungiInput").value=null;
    });
    document.getElementById("rimuoviButton").addEventListener("click",(event)=>{
        let q = document.getElementById("qty-label-modal").innerHTML;
        let a = document.getElementById("rimuoviInput").value;
        q-=a;
        if(q<0){
            q=0;
        }
        document.getElementById("qty-label-modal").innerHTML=q;
        document.getElementById("rimuoviInput").value=null;
    });
    document.getElementById("increase-quantity-button").addEventListener("click",(event)=>{
        let q = parseInt(document.getElementById("qty-label-modal").innerHTML);
        document.getElementById("qty-label-modal").innerHTML=++q;
    });
    document.getElementById("decrease-quantity-button").addEventListener("click",(event)=>{
        let q = parseInt(document.getElementById("qty-label-modal").innerHTML);
        if(--q<0){
            q=0;
        }
        document.getElementById("qty-label-modal").innerHTML=q;
    });

    //-----------------SEARCHBAR----------------
    searchInput = document.getElementById("searchInput");
    searchInput.addEventListener("input", (event) => {
        //aggiungere un piccolo timer di modo che cerchi quando finisce di digitare
        if(searchInput.value.length>1 || searchInput.value.length==0){
            searchProducts();
        }
    });
    
    //----------------LOGIN MODAL------------------
    document.getElementById('inputUser').addEventListener('keyup', function (e) {
        if (e.key === "Enter") {
          sendLoginForm();
        }
    });
    document.getElementById('inputPassword').addEventListener('keyup', function (e) {
        if (e.key === "Enter") {
          sendLoginForm();
        }
    });
    //------------------------FILTER BUTTON-------------------------
    document.getElementById("filterButton").addEventListener("click",(event)=>{
        const toSearch = document.getElementById("searchInput").value;
        category = document.getElementById("categorySelect").value;
        getProducts(toSearch);   
    });
});





loginModalManager();



//--------------------------------------------------------------------------

//--------------------------------------------PAGINATION----------------------------------------


async function refreshPageNumber(){
    let indexBar = document.querySelector(".pagination-bar .btn-group");
    indexBar.innerHTML="";
    if(pages>1){
        for(let i = 0; i< pages; i++){
            let pageIndexButton = document.createElement("button");
            pageIndexButton.setAttribute('type','button');
            pageIndexButton.className = "btn btn-primary"+(i==(page-1)?" active":"");
            pageIndexButton.setAttribute("onclick","goToPage("+(i+1)+")");
            pageIndexButton.innerHTML=(i+1);
            indexBar.appendChild(pageIndexButton);
        }
    }
}
async function goToPage(pageNum){
    page=pageNum;
    getProducts();
}
//--------------------------------------------PAGINATION----------------------------------------

//-------------------------SESSION OPERATIONS----------------------

async function checkSession(){
    const res = await postData(hostAddr+"/getProducts?logged=1");
    if(res.id == 1){
        return true;
    }
    else{
        return false;
    } 
}

function showLoginModal(){
    document.querySelector(".overall.loginModal").style.display="block";
}
function hideLoginModal(){
    document.querySelector(".overall.loginModal").style.display="none";
}


async function loginModalManager(){
    let logged = await checkSession();
    if(logged){
        hideLoginModal();
        getProducts();
    }else{
        showLoginModal();
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

//-------------------------SESSION OPERATIONS----------------------


//------------------------------------------DATA FETCHING OPERATIONS--------------------------------------
async function postData(url = "", toSend ) {
    const response = await fetch(url, {
      method: "POST", 
      mode: "cors", 
      cache: "no-cache", 
      credentials: "include", 
      headers: {
        "Content-Type": "application/json"
      },
      redirect: "follow", 
      referrerPolicy: "no-referrer", 
      body: JSON.stringify(toSend), 
    });
    const data = await response.json();
    return  data;
}

async function getProducts(toSearch=""){
    const url = hostAddr+"/getProducts?page_size="+page_size+"&"+(category!=-1 ? ("&category="+category) : "" );
    //alert(url);
    //const url = hostAddr+"/test" ;
    const sendData = {
        "page" : page,
        "search" : ( toSearch)
    };
    const res = await postData(url,sendData);
    switch (res.id){
        case "-1":
            alert(err1);
            loginModalManager();
        break;
        case "-2":
            alert(err2);
        break;
        default:
            shownProducts = res.products;
            pages = Math.ceil(res.n_products/page_size);
            showProducts();
            refreshPageNumber();
        break;
    }
}

async function searchProducts(){
    const toSearch= document.getElementById("searchInput").value;
    getProducts(toSearch);
}

//------------------------------------------DATA FETCHING OPERATIONS--------------------------------------


function showProducts(){
    document.querySelector(".row.row-cols-auto").innerHTML="";
    shownProducts.forEach(element => {
        createProductCard(element);
    });
    document.getElementById("no-found-alert").style.display=(shownProducts.length!=0? "none": "block");
    
}

function showLocation(id){
    let modal = document.getElementById("locationModal");
    const location = document.getElementById(id).getElementsByClassName("location")[0].value;
    modal.querySelector(".modal-body").innerHTML="La posizione che hai impostato per il tuo prodotto è: <br><i class=\"fa-solid fa-map-pin\"></i><b>"+location+"</b>";
}

function createProductCard(product){

    const cardBody = `
    
    <div class="card" id="`+product.id+`">
    <img class="card-img-top" src="`+product.img+`">
    <div class="card-body">
    <div class="row1">
    <div class="prod-name">`+product.name+`</div>
    <button type="button" class="btn btn-secondary" onclick = "showLocation(`+product.id+`)" data-bs-toggle="modal" data-bs-target="#locationModal"><i class="fa-solid fa-location-dot"></i></button>
    </div>
    <div class="row2">
    <button id="qty-button-`+product.id+`" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus-minus"></i> <i class="fa-solid fa-warehouse"></i> <span class="qty">`+product.qty+`</span></button>
    <button type="button" class="btn btn-light"><i class="fa-solid fa-pencil"></i></button>
    </div>
    </div>
    <input type="hidden" class="location" value="`+product.location+`";
    </div>
    `;

    let card = document.createElement("div");
    card.className="col";
    card.innerHTML=cardBody;
    
    
    
    document.querySelector(".row.row-cols-auto").appendChild(card);

    document.getElementById("qty-button-"+product.id).addEventListener("click",(event)=>{
        document.getElementById("qty-label-modal").innerHTML=product.qty;
    });
    
}
