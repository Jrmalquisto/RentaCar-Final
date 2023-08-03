let availableKeywords = [
    'Abuyog',
    'Alangalang',
    'Abuyog',
    'Alangalang',
    'Albuera',
    'Babatngon',
    'Barugo',
    'Bato',
    'Baybay',
    'Burauen',
    'Calubian',
    'Capoocan',
    'Carigara',
    'Dagami',
    'Dulag',
    'Hilongos',
    'Hindang',
    'Inopacan',
    'Isabel',
    'Jaro',
    'Javier (Bugho)',
    'Julita',
    'Kananga',
    'La Paz',
    'Leyte',
    'MacArthur',
    'Mahaplag',
    'Matag-ob',
    'Matalom',
    'Mayorga',
    'Merida',
    'Ormoc',
    'Palo',
    'Palompon',
    'Pastrana',
    'San Isidro',
    'San Miguel',
    'Santa Fe',
    'Tabango',
    'Tabontabon',
    'Tacloban',
    'Tanauan',
    'Tolosa',
    'Tunga',
    'Villaba',
    
];
// alert("hi");
const resultsBox = document.querySelector(".result-box");
const inputBox=document.getElementById("location");

inputBox.onkeyup = function(){
    let result = [];
    let input = inputBox.value;
    resultsBox.hidden=false;
    if(input.length){
        result = availableKeywords.filter((keyword)=>{
            return keyword.toLowerCase().includes(input.toLowerCase());
        });
        console.log(result);
    }
    if(input==""){
        resultsBox.hidden=true;
    }else if(result.length === 0){
        resultsBox.hidden=true;
    }else{
        display(result);
    }
    
}

function display(result){
    const content = result.map((list)=>{
        return "<li onclick=selectInput(this)>" +list+"</li>";
    });

    resultsBox.innerHTML = "<ul>"+content.join('')+"</ul>";
}
function selectInput(list){
    inputBox.value = list.innerHTML;
    resultsBox.innerHTML = '';
}
