# Higher Edge Triangles

#### Project Brief

This project is an accompanying piece to an interactive installation in New London High School in New London, CT. The installation was carried out by Connecticut College students in the course Design: Public Practice in collaboration with HigherEdge, a local non-profit that helps first-generation students go to college. Students responded to three prompts: "My dream is...", "My favorite class is...", and "My hobbies are..." on triangle stickers and placed them onto a canvas in the cafeteria where members of the community could see and be inspired. The purpose of the web component is to take those responses and continue the conversation by suggesting majors, colleges, and careers that are directly related to students' passions in order to help foster a college-going culture.

#### The Design

The site needed to be an easy browsing experience, where users could view one student response at a time as well as easily access and understand our suggestions. For users who might have a specific topic for which they were interested in finding suggestions, there should be a place to view the whole list. Otherwise navigation should be very simple: directional arrows for 'previous' and 'next'.

The installation in the hich school was colorful, and those same colors were carried over to the web. To maintain the sense of interactivity from the installation, there is a slideshow of student responses as well as two sliding panels, one for project information and the other for suggestions. The background is a large photograph of the installation, to further emphasize the connection.

#### Client-Side Interactivity

The client side is a submission browsing experience. There is simple navigation: Previous and Next arrows to change the current topic, a link to Higher Edge, a sliding panel for information about the project and a list of topics, and a sliding panel for our response to that topic. There is a slideshow of 

#### Information Exchange



#### Server-Side Operations



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
    <td>X</td>
  </tr>
  <tr>
    <td>Admin</td>
    <td>X</td>
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

Distribution files are found in `dist/`, which are all that are needed to host and run the site. All development files are found in `dev/`. This project uses **gulp.js** as a task runner to minify CSS and JavaScript as well as to perform other build tasks. More information at [http://gulpjs.com/](http://gulpjs.com/).

For testing, use images included in test_images.zip.