


<section class="container mt-1">
  <h2 class="text-center">勉強会を作成</h2>
  <form action="registerMember.php" method="" onsubmit="" enctype="multipart/form-data"
    class="bg-light p-4 rounded shadow w-50 mx-auto">
    <div class="mb-3">
      <label for="" class="form-label">勉強会名を入力</label>
      <small style="font-size: 10px; color: red;">*必須</small>
      <input type="text" id="" name="" class="form-control" placeholder="例：AWSの勉強しませんか？" required>
    </div>

    <div class="mb-3">
      <label for="" class="form-label">関連するTutti</label>
      <!-- プルダウン -->
      <small style="font-size: 10px; color: red;">*必須</small>
      <input type="text" id="" name="" class="form-control" placeholder="例：AWS" required>
    </div>

    <div class="mb-3">
      <label for="" class="form-label">開催日</label>
      <small style="font-size: 10px; color: red;">*必須</small>
      <input type="text" id="" name="" class="form-control" placeholder="例：11月15日" required>
    </div>

    <div class="mb-3">
      <label for="" class="form-label">開始時間</label>
      <small style="font-size: 10px; color: red;">*必須</small>
      <input type="" name="password" id="" class="form-control" placeholder="例：13時から16時まで" required>
    </div>

    <div class="mb-3">
      <label for="" class="form-label">場所</label>
      <small style="font-size: 10px; color: red;">*必須</small>
      <input type="" name="" id="" class="form-control" placeholder="例：梅田の１番街にあるカフェ" required>
    </div>
    
    <div class="mb-3">
      <label for="" class="form-label">参加人数</label>
      <small style="font-size: 10px; color: red;">*必須</small>
      <input type="" name="" id="" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="" class="form-label">勉強内容</label>
      <small style="font-size: 10px; color: red;">*必須</small><br>
      <textarea name="message" id="message" cols="30" rows="10" required></textarea>
    </div>

    <button type="submit" class="btn btn-dark w-30 d-block mx-auto">作成する</button>
  </form>

  <hr>

</section>

  <hr>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<hr>
<h1>作成した勉強会を編集する</h1><br><br>
<form action="groupDetail.php">
    name<input type="text" placeholder="すとぅってぃ"><br>
    ジャンル <input type="text" placeholder="AWS"><br>
    開催date <input type="text" placeholder="11月15日"><br>
    開始time <input type="text" placeholder="13:00~"><br>
    location <input type="text"><br>
    num_people <input type="text"><br>
    content <input type="text"><br>
    <input type="submit" value="編集する">
</form>

