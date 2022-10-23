let buttonChangeView = document.getElementById('buttonChangeView');

let dayView = document.getElementById('dayView');
let weekView = document.getElementById('weekView');
let monthView = document.getElementById('monthView');

let count = 0; // 0 weekView , 1 mounthView , 2 dayView

buttonChangeView.addEventListener('click' , ()=>{
    if(count < 3){
        count++;
    }
    else{
        count = 0;
    }

    if(count === 0){
        weekView.classList.add('active');

        dayView.classList.remove('active');
        monthView.classList.remove('active');

        weekView.innerText = 'Week View';
    }

    if(count === 1){
        monthView.classList.add('active');

        weekView.classList.remove('active');
        dayView.classList.remove('active');

        monthView.innerText = 'Month View';
    }

    if(count === 2){
        dayView.classList.add('active');

        weekView.classList.remove('active');
        monthView.classList.remove('active');

        dayView.innerText = 'Day View';
    }
})