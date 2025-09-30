import Alpine from "../node_modules/alpinejs/dist/module.esm.js"
window.Alpine = Alpine
Alpine.start()  

fetch('getcourses.php') 
  .then(response => response.json())
  .then(courses => {
    const container = document.querySelector('.course-main');
    let html = ``
    courses.forEach(course => {
      html += `
          <div class="course-div">
            <div class="course-details-div">
              <div class="course-name-div">
                <img src="./assets/courses/${course.ctype}.png" alt="course ${course.ctype} icon">
                <p>${course.cname}</p>
              </div>
              <div class="course-info">
                <div class="course-duration">
                  <p>${course.duration}</p>
                </div>
                <div class="seats-remaining">
                  <p>${course.seatrem} Seats Left</p>
                </div>
              </div>
            </div>
            <div class="course-blurb">
              <p>${course.blurb}</p>
            </div>
            <button class="enroll-button">Enroll</button>
          </div>
      `
    });
    container.innerHTML = html;
  })
  .catch(err => console.error('Error fetching courses:', err));
