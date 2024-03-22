function logout(){
    localStorage.setItem('loggedUserID', '')
    localStorage.setItem('loggedUserNm', '')
    localStorage.setItem('loggedUserType', '')

    window.location = './';
}

function checkLogin(){
    if(localStorage.getItem('loggedUserID') == "" || localStorage.getItem('loggedUserID') === null){
        window.location = './'
    } else{
        document.getElementById('logName').innerHTML = `<b>`+localStorage.getItem('loggedUserNm')+`</b>`
        if(localStorage.getItem('loggedUserType') === 'a'){
            document.getElementById('navigation').innerHTML = `<a href="./Dashboard.html"><i class="fas fa-home"></i><span class="reshide">Home</span></a>`
        }else{
            document.getElementById('navigation').innerHTML = ``
        }
    }
}

function savedLogin(){
    if(localStorage.getItem('loggedUserID') != "" || localStorage.getItem('loggedUserID') !== null){
        if(localStorage.getItem('loggedUserType') == 'a'){
            window.location = './Dashboard.html'
        }else if(localStorage.getItem('loggedUserType') == 'u'){
            window.location = './bill.html'
        }
    }
}

function printPage(){
    window.print()
}

function showThis(){
    document.getElementById('overlay').style.display = 'grid'
}
function closeThis(dialog){
    dialog.style.display = 'none'
}