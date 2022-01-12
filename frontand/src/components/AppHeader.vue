<template>
  <div id="container">
     <div class="row">
        <div class="block">
          <div class="block_inform">
            <div class="block_inform_u">
              Call us<span>: </span> 374616548
            </div>
            <div class="block_inform_u">
              <ul>
                <li>Register</li>
                <li>
                  <a href="/login">login</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="block">

        </div>
     </div>
  </div>
</template>

<script>
export default {
  name: "AppHeader"
}
</script>

<style scoped lang="scss">
  #container {
    width: 100%;
    .row {
      width:90%;
      margin: 0 auto;
      .block:first-child {
        background-color: #6c6464;
      }
      .block {
        width:100%;
        padding: 3px;
        .block_inform {
          display: flex;
          justify-content: space-between;
          padding: 5px;
          .block_inform_u {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            ul {
              display: flex;
              li {
                margin-left: 15px;
                margin-right: 10px;
              }
            }
          }
        }
      }
    }
  }
</style>
