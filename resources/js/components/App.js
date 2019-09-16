import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Header from './header/Header';
import ProjectsList from './projects/List';
import NewProject from './projects/Form';
import SingleProject from './projects/Single';

export default class App extends Component {
    render() {
        return (
            <BrowserRouter>
                <div>
                    <Header />
                    <Switch>
                        <Route exact path='/' component={ProjectsList} />
                        <Route path='/create' component={NewProject} />
                        <Route path='/:id' component={SingleProject} />
                    </Switch>
                </div>
            </BrowserRouter>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
