const navButtons = document.querySelectorAll('.nav-item');
const sections = document.querySelectorAll('.section');

sections[0].classList.add('active');
navButtons.forEach(button => {
  button.addEventListener('click', () => {
    const target = button.dataset.target;
    sections.forEach(section => {
      if (section.id === target) {
        section.classList.add('active');
      } else {
        section.classList.remove('active');
      } 
    });
  });
});

/*
window.onload = () => {
    const popup_btns = document.querySelectorAll(".nav-item");

    popup_btns.forEach(button => {
        button.addEventListener('click', e => {
            const target = e.target.dataset.target;

            const popup_el = document.querySelector(target);
            if(popup_el != null){
                popup_el.classList.toggle('active');
            }
            else{
                alert("Error: Popup element not found");
            }
        });
    });
  }*/