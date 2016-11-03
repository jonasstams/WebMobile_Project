import React from "react"
import { connect } from "react-redux"
import { IndexLink, Link } from "react-router";

export default class NavBar extends React.Component {
  constructor() {
    super()
    this.state = {
      collapsed: true,
    };
  }

  toggleCollapse() {
    const collapsed = !this.state.collapsed;
    this.setState({collapsed});
  }

  render() {
    const { collapsed } = this.state;
    const overviewClass = location.pathname === "/" ? "active" : "";
    const reportsClass = location.pathname.match(/^\/reports/) ? "active" : "";

    const navClass = collapsed ? "collapse" : "";

    return <div id="navBar">
              <nav class="navbar navbar-default">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" onClick={this.toggleCollapse.bind(this)}>
                      <span class="sr-only">Toggle navigation</span>
                      <span class="glyphicon glyphicon-menu-hamburger"></span>
                    </button>
                    <a class="navbar-brand" href="#">Welcome!</a>
                  </div>
                  <div class={"navbar-collapse collapse " + navClass} id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
	                    <li class={overviewClass}><Link to="/" onClick={this.toggleCollapse.bind(this)}><span class="glyphicon glyphicon-flash"/>Dashboard</Link></li>
                      <li class={reportsClass}><Link to="reports" onClick={this.toggleCollapse.bind(this)}><span class="glyphicon glyphicon-bullhorn"/>Daily reports</Link></li>
                    </ul>
                  </div>
                </div>
              </nav>
            </div>
    }
}