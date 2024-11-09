<?php
    require_once 'includes/config_session.inc.php';
    include('includes/header.php');
    if (isset($_SESSION['already'])) {
        echo "<div id='loginAlert'class='alert alert-warning alert-dismissible fade show' role='alert'>
                {$_SESSION['already']}
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        // Unset the flash message after displaying it
        unset($_SESSION['already']);


    }

    include('includes/topbar.php');

   
?>

<!-- Start Categories of The Month -->
<section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-xl-8 m-auto">
                <h1 class="h1">Size Chart</h1>
               
                 <p>
                    Measure your foot using a ruler from the rear of your heel to the tip of your big toe, <br>
                    then use the conversion factor (Inch) shown below. Since most of our patterns fit <br>
                    narror to regular. we advise ordering your normal size. unless otherwise indicated. <br>
                    we advise ordering a size up for halt size and broad feet
                </p>

              
            </div>
            
        </div>

        <div class="row">
        <h2 class="h2size" >Women's Size Conversions</h2>
<table class="size-table" border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>US Sizes</th>
            <th>Euro Sizes</th>
            <th>UK Sizes</th>
            <th>Foot Length (in)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>4</td>
            <td>35</td>
            <td>2</td>
            <td>8.188"</td>
        </tr>
        <tr>
            <td>4.5</td>
            <td>35</td>
            <td>2.5</td>
            <td>8.375"</td>
        </tr>
        <tr>
            <td>5</td>
            <td>35-36</td>
            <td>3</td>
            <td>8.563"</td>
        </tr>
        <tr>
            <td>5.5</td>
            <td>36</td>
            <td>3.5</td>
            <td>8.75"</td>
        </tr>
        <tr>
            <td>6</td>
            <td>36-37</td>
            <td>4</td>
            <td>8.875"</td>
        </tr>
        <tr>
            <td>6.5</td>
            <td>37</td>
            <td>4.5</td>
            <td>9.063"</td>
        </tr>
        <tr>
            <td>7</td>
            <td>37-38</td>
            <td>5</td>
            <td>9.25"</td>
        </tr>
        <tr>
            <td>7.5</td>
            <td>38</td>
            <td>5.5</td>
            <td>9.375"</td>
        </tr>
        <tr>
            <td>8</td>
            <td>38-39</td>
            <td>6</td>
            <td>9.5"</td>
        </tr>
        <tr>
            <td>8.5</td>
            <td>39</td>
            <td>6.5</td>
            <td>9.688"</td>
        </tr>
        <tr>
            <td>9</td>
            <td>39-40</td>
            <td>7</td>
            <td>9.875"</td>
        </tr>
        <tr>
            <td>9.5</td>
            <td>40</td>
            <td>7.5</td>
            <td>10"</td>
        </tr>
        <tr>
            <td>10</td>
            <td>40-41</td>
            <td>8</td>
            <td>10.188"</td>
        </tr>
        <tr>
            <td>10.5</td>
            <td>41</td>
            <td>8.5</td>
            <td>10.375"</td>
        </tr>
        <tr>
            <td>11</td>
            <td>41-42</td>
            <td>9</td>
            <td>10.5"</td>
        </tr>
        <tr>
            <td>11.5</td>
            <td>42</td>
            <td>9.5</td>
            <td>10.688"</td>
        </tr>
        <tr>
            <td>12</td>
            <td>42-43</td>
            <td>10</td>
            <td>10.875"</td>
        </tr>
    </tbody>
</table>

        </div>

        <div class="row">
        <h2 class="h2size">Men's Size Conversions</h2>
<table class="size-table" border="1" cellpadding="10" cellspacing="0"  >
    <thead>
        <tr>
            <th>US Sizes</th>
            <th>Euro Sizes</th>
            <th>UK Sizes</th>
            <th>Foot Length (in)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>6</td>
            <td>39</td>
            <td>5.5</td>
            <td>9.25"</td>
        </tr>
        <tr>
            <td>6.5</td>
            <td>39</td>
            <td>6</td>
            <td>9.5"</td>
        </tr>
        <tr>
            <td>7</td>
            <td>40</td>
            <td>6.5</td>
            <td>9.625"</td>
        </tr>
        <tr>
            <td>7.5</td>
            <td>40-41</td>
            <td>7</td>
            <td>9.75"</td>
        </tr>
        <tr>
            <td>8</td>
            <td>41</td>
            <td>7.5</td>
            <td>9.938"</td>
        </tr>
        <tr>
            <td>8.5</td>
            <td>41-42</td>
            <td>8</td>
            <td>10.125"</td>
        </tr>
        <tr>
            <td>9</td>
            <td>42</td>
            <td>8.5</td>
            <td>10.25"</td>
        </tr>
        <tr>
            <td>9.5</td>
            <td>42-43</td>
            <td>9</td>
            <td>10.438"</td>
        </tr>
        <tr>
            <td>10</td>
            <td>43</td>
            <td>9.5</td>
            <td>10.563"</td>
        </tr>
        <tr>
            <td>10.5</td>
            <td>43-44</td>
            <td>10</td>
            <td>10.75"</td>
        </tr>
        <tr>
            <td>11</td>
            <td>44</td>
            <td>10.5</td>
            <td>10.938"</td>
        </tr>
        <tr>
            <td>11.5</td>
            <td>44-45</td>
            <td>11</td>
            <td>11.125"</td>
        </tr>
        <tr>
            <td>12</td>
            <td>45</td>
            <td>11.5</td>
            <td>11.25"</td>
        </tr>
        <tr>
            <td>13</td>
            <td>46</td>
            <td>12.5</td>
            <td>11.563"</td>
        </tr>
        <tr>
            <td>14</td>
            <td>47</td>
            <td>13.5</td>
            <td>12.188"</td>
        </tr>
        <tr>
            <td>15</td>
            <td>48</td>
            <td>14.5</td>
            <td>12.125"</td>
        </tr>
        <tr>
            <td>16</td>
            <td>49</td>
            <td>15.5</td>
            <td>12.5"</td>
        </tr>
    </tbody>
</table>

        </div>
        
     
    </section>
    <!-- End Categories of The Month -->







<?php include('includes/footer.php'); ?>