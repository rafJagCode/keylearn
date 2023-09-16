# $\color{orange}{Keylearn}$ _- increase your typing speed_

Keylearn is an web app designed to help you learn quick typing and to collect information about your progress towards
achieving this goal.

`TESTING CREDENTIALS: test@test.com \ test123`

## [🔗 CLICK TO SEE IT LIVE](https://keylearn.rafaljagielski.pl)

## $\color{orange}{Table\ of\ Contents}$

[⚓ General Informations](#general-informations)<br> [⚓ Technologies](#technologies)<br> [⚓ Features](#features)<br>
[⚓ Usage](#usage)<br> [⚓ License](#license)

## $\color{orange}{General\ Informations}$

Training with Keylearn consists of rewriting the displayed text as quickly as possible. Displayed text can be generated
randomly from the base of english words or can be provided by the user. Each complated test is analyzed and then
obtained results are saved to the database.

## $\color{orange}{Features}$

- Account registration and login
- Creating, editing and removing profiles
- Collecting and displaying tests results
- Displaying statistics about complated tests and typed words and letters
- Auto difficulty adjustment for user provided texts based on results

## $\color{orange}{Technologies}$

List of technologies used to build the app:

**Database:**<br> 🔗 [mysql] - open-source relational database management system.<br>

**Backend:**<br> 🔗 [laravel] - php web application framework.

**Frontend:**<br> 🔗 [vue] - progressive JavaScript Framework.<br> 🔗 [vuetify] - Open Source UI Library with
beautifully handcrafted Vue Components.<br> 🔗 [vue-chartjs] - wrapper for Chart.js in Vue.<br> 🔗 [vue-keypress] -
global keypress event handler component for Vue.js 2 applications.<br> 🔗 [vue-router] - expressive, configurable and
convenient routing for Vue.js.<br> 🔗 [vuex] - state management pattern + library for Vue.js applications. <br> 🔗
[vue-axios] - small wrapper for integrating axios to Vue.<br> 🔗 [howler.js] - audio library for the modern web.<br>

## $\color{orange}{Usage}$

### $\color{orange}{Practice\ Typing}$

![App Screenshot](./readme_images/keylearn_practice.png)

App generates text to type. User by pressing ENTER on the keyboard can start the test. Time starts when user starts
typing.

### $\color{orange}{Registration\ and\ login}$

![App Screenshot](./readme_images/keylearn_register.png)

To save practice results and statistics user has to create account and login.

### $\color{orange}{Dashboard}$

When logged user has access to dashboard, where he can see collected results and statistics.

##### $\color{orange}{General\ Statistics}$

![App Screenshot](./readme_images/keylearn_dashboard.png)

##### $\color{orange}{Tests\ History}$

![App Screenshot](./readme_images/keylearn_test_history.png)

##### $\color{orange}{Words\ Statistics}$

![App Screenshot](./readme_images/keylearn_words_statistics.png)

### $\color{orange}{Managing\ Profiles}$

User can create, update, remove profiles. Each profile can have different settings.Collected data is separated for each
profile. Currently used profile can be changed in any moment.

![App Screenshot](./readme_images/keylearn_profile_manager.png)

While creating profile user can set the test length and can choose if words should be generated randomly or if app
should use words provided by user.

![App Screenshot](./readme_images/keylearn_creating_profile.png)

## $\color{orange}{License}$

MIT

[mysql]: https://www.mysql.com
[laravel]: https://laravel.com
[vue]: https://vuejs.org
[vuetify]: https://vuetifyjs.com
[vue-chartjs]: https://vue-chartjs.org
[vue-keypress]: https://www.npmjs.com/package/vue-keypress
[vue-router]: https://router.vuejs.org
[vuex]: https://vuex.vuejs.org
[vue-axios]: https://www.npmjs.com/package/vue-axios
[howler.js]: https://howlerjs.com
