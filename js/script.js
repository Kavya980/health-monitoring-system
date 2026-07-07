const counters = document.querySelectorAll('.counter');

counters.forEach(counter => {

let target = +counter.innerText;
let count = 0;

const update = () => {

let increment = target / 50;

if(count < target){

count += increment;
counter.innerText = Math.ceil(count);

setTimeout(update, 30);

}else{

counter.innerText = target;

}

};

update();

});
document.querySelectorAll('.tip-card').forEach(card=>{
card.style.opacity="0";
card.style.transform="translateY(20px)";

setTimeout(()=>{
card.style.transition="0.5s";
card.style.opacity="1";
card.style.transform="translateY(0)";
},200);
});

/* STATISTICS CHARTS */

if(document.getElementById("barChart")){

const dataValues = [diet, exercise, mental, sleep];

const labels = ['Diet','Exercise','Mental Health','Sleep'];

/* BAR CHART */

new Chart(document.getElementById('barChart'),{
type:'bar',
data:{
labels:labels,
datasets:[{
label:'Number of Tips',
data:dataValues
}]
}
});

/* PIE CHART */

new Chart(document.getElementById('pieChart'),{
type:'pie',
data:{
labels:labels,
datasets:[{
data:dataValues
}]
}
});

}