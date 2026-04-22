<div class="modalBG hide" id="registerModal" >
<div class="chooseRoleContainer p-5">
  <h1>Register</h1>
  <div class="d-flex gap-5 mt-5"> 
    <button  onclick="window.location.href='/register?r=Employer';" class="btn btn-primary">Employer</button>
    <button  onclick="window.location.href='/register?r=Employee';" class="btn btn-primary">Employee</button>
  </div>
</div>
</div>

<script>

  function openModal(currentModal) {
      let modalActive = document.getElementById(currentModal);
    const isHidden = modalActive.classList.contains("hide");

    modalActive.classList.toggle("hide", !isHidden);
    modalActive.classList.toggle("show", isHidden);
  }
</script>