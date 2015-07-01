  <form method='post' class='aSync' action='{action}'>
    <table>
      <tr>
        <th>Title</td>
        <td><input type='text' name='title' value='{newsTitle}' /></td>
      </tr>
      <tr>
        <td colspan="2"><input type='hidden' value='1' name='saveContent' /><textarea name='newsContent' id='editfield'>{newsContent}</textarea></td>
      </tr>
      <tr>
        <td style='text-align:center;' colspan='2'>{edit}<input type='hidden' name='save' value='1' /><a class='submit btn btn-success'>Save</a></td>
      </tr>
    </table>
  </form>
