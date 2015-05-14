# Higher Edge Triangles

#### Project Brief

This project is an accompanying piece to an interactive installation in New London High School in New London, CT. The installation was carried out by Connecticut College students in the course Design: Public Practice in collaboration with HigherEdge, a local non-profit that helps first-generation students go to college. Students responded to three prompts: "My dream is...", "My favorite class is...", and "My hobbies are..." on triangle stickers and placed them onto a canvas in the cafeteria where members of the community could see and be inspired. The purpose of the web component is to take those responses and continue the conversation by suggesting majors, colleges, and careers that are directly related to students' passions in order to help foster a college-going culture.

#### The Design

The site needed to be an easy browsing experience, where users could view one student response at a time as well as easily access and understand our suggestions. For users who might have a specific topic for which they were interested in finding suggestions, there should be a place to view the whole list. Otherwise navigation should be very simple: directional arrows for 'previous' and 'next'.

The installation in the hich school was colorful, and those same colors were carried over to the web. To maintain the sense of interactivity from the installation, there is a slideshow of student responses as well as two sliding panels, one for project information and the other for suggestions. The background is a large photograph of the installation, to further emphasize the connection.

#### Client-Side Interactivity

The client side is a submission browsing experience. There is simple navigation: Previous and Next arrows to change the current topic, a link to Higher Edge, a sliding panel for information about the project and a list of topics, and a sliding panel for our response to that topic. There is also an auto-playing slideshow of photos of real student submissions related to the current topic.

#### Information Exchange

On load, the topic template page (`index.php`) is either provided with a topic_id query in the address or it will randomly select one, and then it populates all content areas (topic title, category, topic cloud in the project information sliding panel, and all categorical data in the information sliding panel) from the database. The first (placeholder) image in the slideshow is also populated with PHP directly from the `img/uploads/` folder. Then, once the page has loaded, an AJAX call is placed to retrieve the other images and once they are loaded, the slideshow begins.

#### Server-Side Operations

The user interface to manage server side operations is the administration panel (`admin.php`). It consists form controls for managing the database. Until commented out upon release, adding `?drop` and `?create` to the address bar will modify the database. All other administrative functions use `POST` and are password-protected. The password is hashed and stored in a separate database table.

The file `debug.php` is a database preview where tables are printed out for inspection of all 8 tables. This is for visualizing current database status without using phpmyadmin.

With the form, a user can add new topics, upload as many photos of student submissions as necessary, and insert the new record into all 8 database tables. The user may also remove a topic, which will delete all records related to that topic from all 8 tables as well as delete all uploaded images related to that topic from `img/uploads/`.

#### Page Technology Breakdown

<table>
  <tr>
    <th>Name</th>
    <th>HTML5</th>
    <th>jQuery</th>
    <th>AJAX</th>
    <th>PHP</th>
    <th>MySQL</th>
  </tr>
  <tr>
    <td>Home</td>
    <td>X</td>
    <td>X</td>
    <td>X</td>
    <td>X</td>
    <td></td>
  </tr>
  <tr>
    <td>Admin</td>
    <td>X</td>
    <td>X</td>
    <td></td>
    <td>X</td>
    <td>X</td>
  </tr>
  <tr>
    <td>Debug</td>
    <td></td>
    <td></td>
    <td></td>
    <td>X</td>
    <td>X</td>
  </tr>
</table>

#### Plugins

**slick.js** This site uses a barebones Slick slider for the image slideshow on the browsing page. More information at [http://kenwheeler.github.io/slick/](http://kenwheeler.github.io/slick/).

---

## Setup

Distribution files are found in `dist/`, which are all that are needed to host and run the site. All development files are found in `dev/`. This project uses **gulp.js** as a task runner to minify CSS and JavaScript as well as to perform other build tasks. More information at [http://gulpjs.com/](http://gulpjs.com/). Requires [Node](https://nodejs.org/), [Ruby](https://www.ruby-lang.org/en/), and [Sass](http://sass-lang.com/).

To change MySQL settings credentials, see line 6 of `db-connect.php`.

For testing, use images included in `test_images.zip`.