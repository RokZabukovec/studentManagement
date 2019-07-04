let deleteBtn = Array.from(document.getElementsByClassName('deleteBtn'));

console.log(deleteBtn);

deleteBtn.forEach((btn)=>{
    btn.addEventListener('click', ()=>{
        let confirmed = confirm('Do you want to delete?');
        if(confirmed){
            return true;
        }
    });
});


