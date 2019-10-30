const questions = document.getElementById('questions_table');

if(questions){
    questions.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger question-delete'){
            if(confirm('Are you sure?')){
                const id = e.target.getAttribute('data-id');

                fetch(`/question/delete/${id}`,{
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}
