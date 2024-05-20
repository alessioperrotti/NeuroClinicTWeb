document.addEventListener('DOMContentLoaded', function (){
    
    let freqDivFarm = document.getElementById('freqDivId1');
    let checkboxFarm = document.getElementById('freqCheckId1');

    checkboxFarm.addEventListener('onChange', function() {
        freqDivFarm.classList.toggle('hidden');
    });

    let freqDivAtt = document.getElementById('freqDivId2');
    let checkboxAtt = document.getElementById('freqCheckId2');

    checkboxAtt.addEventListener('onChange', function() {
        freqDivAtt.classList.toggle('hidden');
    });
});
