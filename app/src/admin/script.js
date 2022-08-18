const Searchcontent = document.querySelector('#content');
const peopleSearch = document.querySelector('#search');
const seacrhPeople = () => {
const val = peopleSearch.ariaValueMax.toLowerCase();
console.log(value);
Searchcontent.forEach(table => {
    let name = table.querySelector('h5').textContent.toLowerCase();
    if(name.indexOf(val) != -1){
    table.style.display = 'flex';
    } else{
    table.style.display = 'none';
    }
})
}
  
//People Search
peopleSearch.addEventListener('keyup', seacrhPeople);