// Delete qusetion
const questions = document.getElementById('questions_table');

if(questions){
    questions.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger question-delete'){
        if(confirm('Are you sure?')){
            const id = e.target.getAttribute('data-id');

            fetch(`/admin/question/delete/${id}`,{
                method: 'DELETE'
            }).then(res => window.location.reload());
        }
    }
});
}

// Delete answer
const answer = document.getElementById('answer_table');

if(answer){
    answer.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger answer-delete'){
        if(confirm('Are you sure?')){
            const id = e.target.getAttribute('data-id');

            fetch(`/admin/answer/delete/${id}`,{
                method: 'DELETE'
            }).then(res => window.location.reload());
        }
    }
});
}

//Reset poll result
const poll = document.getElementById('poll_reset');

if(poll){
    poll.addEventListener('click', e => {
        if(e.confirm('Are you sure?')){

        }
        // if(e.target.className === 'btn btn-danger poll_reset'){
            // if(confirm('Are you sure?'))
            //     confirm('Are you sure?');
            // {
            //     const id = e.target.getAttribute('data-id');
            //
            //     fetch(`/admin/answer/delete/${id}`,{
            //         method: 'DELETE'
            //     }).then(res => window.location.reload());
            // }
        // }
    });
}

