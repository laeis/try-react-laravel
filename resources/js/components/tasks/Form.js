
import React,{ Component } from 'react'

class TaskForm extends Component {
    constructor (props) {
        super(props)
        this.state = {
            title: '', 
            errors: [],
        }
        this.handleFieldChange = this.handleFieldChange.bind(this);
        this.hasErrorFor = this.hasErrorFor.bind(this);
        this.renderErrorFor  = this.renderErrorFor.bind(this);
        this.handleAddNewTask = this.handleAddNewTask.bind(this);
    }
    
    // add these outside the `constructor`, as a standalone methods
    handleFieldChange (event) {
        this.setState({
          title: event.target.value
        })
    }
  
    handleAddNewTask (event) {
        event.preventDefault()
  
        const task = {
          title: this.state.title,
          project_id: this.props.project.id
        }
  
        axios.post('/api/tasks', task)
          .then(response => {
            // clear form input
            this.setState({
              title: ''
            })
            // add new task to list of tasks
            this.props.addTaskToList(response.data);
          })
          .catch(error => {
            this.setState({
              errors: error.response.data.errors
            })
          })
    }
  
    hasErrorFor (field) {
        return !!this.state.errors[field]
      }
  
      renderErrorFor (field) {
        if (this.hasErrorFor(field)) {
          return (
            <span className='invalid-feedback'>
              <strong>{this.state.errors[field][0]}</strong>
            </span>
          )
        }
      }

    render(){
        return (
            <form onSubmit={this.handleAddNewTask}>
                <div className='input-group'>
                    <div className="input-group-prepend">
                        <span className="input-group-text">New Task</span>
                    </div>
                    <input
                        type='text'
                        name='title'
                        className={`form-control ${this.hasErrorFor('title') ? 'is-invalid' : ''}`}
                        placeholder='Task title'
                        value={this.state.title}
                        onChange={this.handleFieldChange}
                    />
                    <div className='input-group-append'>
                        <button className='btn btn-primary'>Add</button>
                    </div>
                    {this.renderErrorFor('title')}
                </div>
            </form>
        )
    }
}


export default TaskForm;