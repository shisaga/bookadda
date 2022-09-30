<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
opacity:0.5;
  visibility: hidden;
  width: 200px;
  background-color: blue;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  top: -5px;
  right: 105%;
  margin-left: -60px;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 12%;
  left: 100%;
  margin-top: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent transparent transparent blue;
}
.tooltip:hover .tooltiptext {
  visibility: visible;
}
  </style>
<div class="tooltip">Security Deposit : ₹
			  <span class="tooltiptext">This Security Deposit is refundable, and you will receive a refund after you return our book in the same condition as when it was given to you. Each book costs 500₹.</span>
			</div> 