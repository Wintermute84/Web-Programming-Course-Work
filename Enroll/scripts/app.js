import Alpine from "../node_modules/alpinejs/dist/module.esm.js"
window.Alpine = Alpine
Alpine.start()  

if(document.querySelector('.course-main')){
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
              <button class="enroll-button" data-cid="${course.cid}">Enroll</button>
            </div>
        `
      });
      container.innerHTML = html;
      document.querySelectorAll('.enroll-button').forEach(button => {
        button.addEventListener('click', (e) => {
          console.log('clicked')
          const cid = e.target.dataset.cid;

          fetch('enroll.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `cid=${cid}`
          })
          .then(res => res.text())
          .then(msg => {
            alert(msg);
            location.reload();
          })
          .catch(err => console.error(err));
        });
      });
    })
    .catch(err => console.error('Error fetching courses:', err));
  }


  if(document.querySelector('.my-course-main')){
  fetch('getmycourses.php') 
    .then(response => response.json())
    .then(courses => {
      let html = ``;
      const container = document.querySelector('.my-course-main');
      console.log(courses)
      if(Object.keys(courses).length === 0){
        html = `<p style="margin:auto;font-size:1.6rem;">You have not currently registered for any courses!</p>`;
      }     
      else{ 
        courses.forEach(course => {
          html += `
              <div class="course-div">
                <div class="my-course-details-div">
                  <div class="course-name-div">
                    <img src="./assets/courses/${course.ctype}.png" alt="course ${course.ctype} icon">
                    <p>${course.cname}</p>
                  </div>
                </div>
                <div class="course-blurb">
                  <p>${course.blurb}</p>
                </div>
                <button class="disenroll-button" data-cid="${course.cid}">Disenrol</button>
              </div>
          `
        });
      }
      container.innerHTML = html;
      document.querySelectorAll('.disenroll-button').forEach(button => {
        button.addEventListener('click', (e) => {
          console.log('clicked')
          const cid = e.target.dataset.cid;

          fetch('disenroll.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `cid=${cid}`
          })
          .then(res => res.text())
          .then(msg => {
            alert(msg);
            location.reload();
          })
          .catch(err => console.error(err));
        });
      });
    })
    .catch(err => console.error('Error fetching courses:', err));
  }


