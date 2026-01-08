    const authModal = document.getElementById('auth-modal');
    const openLoginBtn = document.querySelector('.open-login-modal');
    const closeAuthBtn = document.getElementById('close-auth-modal');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const showRegisterBtn = document.getElementById('show-register');
    const showLoginBtn = document.getElementById('show-login');

openLoginBtn.addEventListener('click', e => {
    loginForm.classList.remove('hidden');
    registerForm.classList.add('hidden');
    authModal.classList.remove('hidden');
  });

closeAuthBtn.addEventListener('click', () => {
    authModal.classList.add('hidden');
  });

showRegisterBtn.addEventListener('click', () => {
    loginForm.classList.add('hidden');
    registerForm.classList.remove('hidden');
  });

showLoginBtn.addEventListener('click', () => {
    registerForm.classList.add('hidden');
    loginForm.classList.remove('hidden');
  });


const listvehicles = document.getElementById('listvehicles');
const search = document.getElementById('search');


let carsData = [];

fetch('./controlls/getVehicleData.php')
  .then(response => response.json())
  .then(data => {
    carsData = data;
    renderCars(carsData);
  })

search.addEventListener('keyup', () => {

  const filteredCars = carsData.filter(car =>
    car.model.toLowerCase().includes(search.value.toLowerCase())
  );

     renderCars(filteredCars);
});

function renderCars(cars) {
  listvehicles.innerHTML = '';

  if (cars.length === 0) {
    listvehicles.innerHTML = `
      <p class="col-span-3 text-center text-gray-400 text-lg">
        No vehicles found
      </p>
    `;
    return;
  }

  cars.forEach(car => 
    showVehicles(car)
    );
}

function showVehicles(car) {
  const newdiv = document.createElement('div');

  newdiv.innerHTML = `
    <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-yellow-500/20 transition">
      <img src="${car.Vehicle_image}" 
           class="h-48 w-full object-cover transition-transform duration-300 hover:scale-105" />

      <div class="p-5">
        <h4 class="font-semibold text-xl text-white mb-1">
          ${car.model}
        </h4>

        <a href="./View/Vehicle_details.php?id=${car.vehicle_id}"
           class="mt-4 inline-block bg-yellow-500 text-black px-4 py-2 rounded-lg font-semibold
                  hover:bg-yellow-400 transition">
          View Details
        </a>
      </div>
    </div>
  `;

  listvehicles.appendChild(newdiv);
}
