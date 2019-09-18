
    import axios from 'axios';
    import React, { Component } from 'react';
    import TaskList from '../tasks/List';
    import TaskForm from '../tasks/Form';

    class SingleProject extends Component {
      constructor (props) {
        super(props)
        this.state = {
          project: {},
          tasks: []
        }
        this.handleMarkProjectAsCompleted = this.handleMarkProjectAsCompleted.bind(this);
        this.handlerAddNewTask = this.handlerAddNewTask.bind(this);
        this.handleMarkTaskAsCompleted = this.handleMarkTaskAsCompleted.bind(this);
      }


      handleMarkProjectAsCompleted () {
        const { history } = this.props

        axios.put(`/api/projects/${this.state.project.id}`)
          .then(response => history.push('/'))
      }

      handlerAddNewTask(tasks){
        this.setState(prevState => ({
          tasks: prevState.tasks.concat(tasks)
        }))
      }

      handleMarkTaskAsCompleted(taskId){
        this.setState(prevState => ({
          tasks: prevState.tasks.filter((item) => item.id !== taskId)
        }))
      }

      componentDidMount () {
        const projectId = this.props.match.params.id

        axios.get(`/api/projects/${projectId}`).then(response => {
          this.setState({
            project: response.data,
            tasks: response.data.tasks || []
          })
        })
      }

      render () {
        const { project, tasks } = this.state

        return (
          <div className='container py-4'>
            <div className='row justify-content-center'>
              <div className='col-md-8'>
                <div className='card'>
                  <div className='card-header'>{project.name}</div>
                  <div className='card-body'>
                    <p>{project.description}</p>

                    <button 
                      className='btn btn-primary btn-sm'
                      onClick={this.handleMarkProjectAsCompleted}
                    >
                      Mark as completed
                    </button>

                    <hr />

                    <TaskList data={tasks} taskAsCompletedState={this.handleMarkTaskAsCompleted}/>
                    <hr />
                    <TaskForm project={project} addTaskToList={this.handlerAddNewTask}/>    
                  </div>
                </div>
              </div>
            </div>
          </div>
        )
      }
    }

    export default SingleProject