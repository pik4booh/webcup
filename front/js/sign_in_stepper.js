function nextStep(step) {
    document.getElementById('step' + step).style.display = 'block';
    document.getElementById('step' + (step - 1)).style.display = 'none';
}

function prevStep(step) {
    document.getElementById('step' + step).style.display = 'block';
    document.getElementById('step' + (step + 1)).style.display = 'none';
}