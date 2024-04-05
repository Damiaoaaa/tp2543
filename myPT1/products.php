<!DOCTYPE html>
<html>
<head>
  <title>My Booking Ordering System : Products</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="products.php" method="get">
      Product ID
      <input name="pid" type="text" placeholder="Insert ID" required> <br>
      Name
      <input name="name" type="text" placeholder="Insert book's name" required> <br>
      Type
      <input name="type" type="text" placeholder="Insert book's type" required> <br>
      Published
      <input name="published" type="text" placeholder="Insert book's published" required> <br>
      Language
      <select name="language">
        <option value="english" selected>English</option>
        <option value="french">French</option>
        <option value="russian">Russian</option>
        <option value="malayisa">Malayisa</option>
        <option value="chinese">Chinese</option>
      </select> 
      <br>
      Author
       <input name="authot" type="text" placeholder="Insert book's author" required>
       <br>
      Price
      <input type="range" name="price" id="priceId" min = "1" max = "100" value = "50" oninput="outputId.value = priceId.value"><output id="outputId">50</output>$
       <br>
      <button type="submit" name="create">Create</button>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Product ID</td>
        <td>Name</td>
        <td>Type</td>
        <td>Published</td>
        <td>Language</td>
        <td>Author</td>
        <td>Price</td>
        <td></td>
      </tr>
      <tr>
        <td>001</td>
        <td>Alice's Adventures in Wonderland: Annotated</td>
        <td>Fantasy</td>
        <td>November 1865</td>
        <td>English</td>
        <td>Lewis Carroll</td>
        <td>22</td>
        <td>
          <a href="products_details.php">Details</a>
          <a href="products.php">Edit</a>
          <a href="products.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>002</td>
        <td>The Little Prince</td>
        <td>Romantic</td>
        <td>April 1943</td>
        <td>French</td>
        <td>Antoine de Saint-Exupéry</td>
        <td>12</td>
        <td>
          <a href="products.php">Edit</a>
          <a href="products.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>003</td>
        <td>Tuesdays with Morrie</td>
        <td>Classics</td>
        <td>August 1997</td>
        <td>English</td>
        <td>Mitch Albom</td>
        <td>20</td>
        <td>
          <a href="products.php">Edit</a>
          <a href="products.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>004</td>
        <td>David Copperfield</td>
        <td>Novel</td>
        <td>May 1849</td>
        <td>English</td>
        <td>Charles Dickens</td>
        <td>45</td>
        <td>
          <a href="products.php">Edit</a>
          <a href="products.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>005</td>
        <td>Mrs Dalloway</td>
        <td>Hrdback</td>
        <td>May 1925</td>
        <td>English</td>
        <td>Virginia Woolf</td>
        <td>17</td>
        <td>
          <a href="products.php">Edit</a>
          <a href="products.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>006</td>
        <td>Lincoln in the Bardo</td>
        <td>Historical ficti</td>
        <td>February 2017</td>
        <td>English</td>
        <td>George Saunders</td>
        <td>14</td>
        <td>
          <a href="products.php">Edit</a>
          <a href="products.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>007</td>
        <td>Jane Eyre</td>
        <td>Gothic</td>
        <td>October 1847</td>
        <td>English</td>
        <td>Charlotte Brontë</td>
        <td>19</td>
        <td>
          <a href="products.php">Edit</a>
          <a href="products.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>008</td>
        <td>Great Expectations</td>
        <td>Novel</td>
        <td>1860</td>
        <td>English</td>
        <td>Charles Dickens</td>
        <td>61</td>
        <td>
          <a href="products.php">Edit</a>
          <a href="products.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>009</td>
        <td>Middlemarch</td>
        <td>Novel</td>
        <td>September 1829</td>
        <td>English</td>
        <td>George Eliot</td>
        <td>23</td>
        <td>
          <a href="products.php">Edit</a>
          <a href="products.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>010</td>
        <td>Vanity Fair</td>
        <td>Novel</td>
        <td>January 1847</td>
        <td>English</td>
        <td>William Makepeace Thackeray</td>
        <td>24</td>
        <td>
          <a href="products.php">Edit</a>
          <a href="products.php">Delete</a>
        </td>
      </tr>
    </table>
  </center>
</body>
</html>