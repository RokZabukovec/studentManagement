let deleteBtn = Array.from(document.getElementsByClassName('deleteBtn'));

deleteBtn.forEach((btn)=>{
    btn.addEventListener('click', ()=>{
        let confirmed = confirm('Do you want to delete?');
        if(confirmed){
            return true;
        }
    });
});

let closeBtn = document.querySelector('.close');
let openModal = document.querySelector('.add-new');
let modal = document.querySelector('.modal');

    openModal.addEventListener('click', ()=>{
        modal.style.display = 'block';
    });

closeBtn.addEventListener('click', ()=>{
    modal.style.display = 'none';
});

console.log(closeBtn);


