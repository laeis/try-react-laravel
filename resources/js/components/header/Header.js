import React from 'react';
import { Link } from 'react-router-dom';

const Header = () => (
    <nav className="navbar navbar-expand-md navbar-ligth navbar-laravel">
        <div className="container">
            <Link className="navbar-brand" to="/">TaskMan</Link>
        </div>
    </nav>
)

export default Header;