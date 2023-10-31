const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
document.querySelector('#logo').onmouseover = event => {
    let i = 0;
  interval = setInterval(() => {
    event.target.innerText = event.target.innerText
      .split("")
      .map((letter, index) => {
        if(index < i) {
          return event.target.dataset.value[index];
        }
        return letters[Math.floor(Math.random() * 26)]
      })
      .join("");
    if(i >= event.target.dataset.value.length){ 
      clearInterval(interval);
    }
    i += 1/3;
}, 50);
}
