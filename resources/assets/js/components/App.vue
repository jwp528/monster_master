<template>
    <div id="app">
      <div class="container">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link to="/" class="nav-link">Cruds</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/about" class="nav-link">About</router-link>
            </li>
          </ul>
        </nav><br />
        <transition name="fade">
          <router-view></router-view>
        </transition>
      </div>
    </div>
</template>

export default{
  data(){
    return {}
  }
}