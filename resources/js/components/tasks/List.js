import axios from 'axios';
import React from 'react';

function markTaskAsCompleted(props, taskId) {
    axios.put(`/api/tasks/${taskId}`)
    .then(response => props.taskAsCompletedState(taskId))
    .catch(error => console.error(error.message))
}

function TasksList(props){

   

    return( 
        <ul className='list-group mt-3'>
            {props.data.map(task => (
            <li
                className='list-group-item d-flex justify-content-between align-items-center'
                key={task.id}
            >
                {task.title}

                <button 
                    className='btn btn-primary btn-sm'
                    onClick={markTaskAsCompleted.bind(null, props, task.id)}       
                >
                    Mark as completed
                </button>
            </li>
            ))}
        </ul>
    )
}

export default TasksList;