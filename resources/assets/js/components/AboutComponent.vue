<template>
  <div class="col-12 bg-light py-3">
    <div class="col-lg-8 col-sm-12 mx-auto">
      <h1 class="text-center mb-5">Monster Master</h1>

      <h4 class="text-muted">Base Functionality</h4>
      <p>
        After taking the default application from the tutorial. I sat down, looked over how the application was put together,
        and the different components that went into it; and started thinking about what I was going to do on top of this.
      </p>

      <h4 class="text-muted mt-5">Deciding not to do the traditional "Todo List" app.</h4>
      <p>
        The first thing that came to mind was to take the suggestion of the email I'd received stating
        I could do another app within the already existing one, but that died when I looked at what I currently had in front of me
        and realized it looked a bit like something you'd see in a Pokémon game.
      </p>
      <p>
        I decided to make a small battle system out of it. I started with the design, adding bootstrap to the project
        so I could take care of things like the buttons, controls, placement, and to create a look that was still good even on mobile.
      </p>

      <h4 class="text-muted mt-5">Creating the Battle System</h4>
      <p>
        After deciding on the look I sat down and modelled out how the battle system was going to work. I added a new Migration
        to the project to add the description, HP, Attack, and Defense stats. and used the already implemented Faker object to generate
        numbers between what I thought was a reasonable range of values.
      </p>
      <p>
        I then set to displaying those new properties, adding the parameters to the object, assigning them to their proper location.
        and even adding new computed properties to keep track of the currentHP of a given monster, and whether that monster was set
        as the active monster. I eventually got to the point where I used bootstraps progress bars coupled with the current HP value
        to create the animated health bar shown in the application.
      </p>
      <p>
        Once the elements were in place it was time to add the functionality. I added the setActive and attack buttons.
        I set the setActive button to be visible dependent on if the monster was the active monster and the attack button was a simiar check
        with a check to make sure an active monster was set at all as well.
      </p>

      <h4 class="text-muted mt-5">Testing</h4>
      <p>
        When testing the application I realized that updating the currentHP of the monsters on each attack was resulting in
        too many requests being sent to the api. So I opted to switch it out so that when a monster is defeated, the one who
        defeated it has it's hp recorded.
      </p>

      <h4 class="text-muted mt-5">Further Expansion</h4>
      <p>
        After I'd completed the application I decided it needed something more. I'd established my ability to alter the database
        and use migrations, complete basic CRUD functionality and further the client functionality, but I felt it was lacking
        something. So I included the vue router as part of the application and built the routes to the application and this
        write up to demonstrate that I can implement functionality from scratch as well.
      </p>

      <h4 class="text-muted mt-5">The Main Development Process</h4>
      <p>
        I started this application with a very basic understanding of laravel, and never having used the vue-cli at all. My Process
        while building out this application was to read and experiment with the laravel framework and discover how the application back
        end worked best using the vue-cli on the front end.
      </p>
      <p>I learned a lot about dependency management, the node package manager, and webpack as well.</p>
    </div>
  </div>
</template>

export default{
    data(){
        return {}
    }
}