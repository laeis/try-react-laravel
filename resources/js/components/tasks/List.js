
import React from 'react';

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
                >
                Mark as completed
                </button>
            </li>
            ))}
        </ul>
    )
}

export default TasksList;