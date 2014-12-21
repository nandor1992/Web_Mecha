<?php
session_start();
?>
<!-- Header -->
<?php
$title= "Model Tecol Tool";
$style=2;
include 'header.php';
?>
            	<section id="sec-1">
                     
                    <p>Economic Framework</p>
                    </div>
               	</section>
                
                <section id="sec-2">
                  <h5><em>Based on The Role of Economics in Cartel Detection in Europe by Hans W. Friederiszick  and Frank P. Maier-Rigau.</em></h5><br>

<p>From an economic point of view collusion describes a situation where market prices are close to monopoly prices despite an oligopolistic market structure. In contrast to unilateral conduct that also may allow prices to rise significantly above the competitive price level in an oligopolistic environment, collusion rests on the dynamic interaction between firms: firms condition their future behaviour in the market on the current behaviour of competitors. For instance, firms may revert to ‘cut throat competition’ for some period in the future in reaction to a competitor’s deviation from collusive price levels. This type of dynamic interaction allows firms to maintain prices at levels close to monopoly prices and significantly above what unilateral conduct alone would allow.
Consider a simple symmetric duopoly situation where the two firms i and j can choose to either compete or collude. Table 1 presents the situation in a typical 2-firm matrix game in normal form where the first value in brackets represents the payoff of firm i and the second the payoff of firm j. If profits are ranked in the following way: a > b > c > d and 2b > a + d > 2c the game is a classic prisoner’s dilemma (PD) game.</p><br>
<p><em>Table 1: General 2×2 prisoner’s dilemma game in normal form.</em></p><br>
<table>
  <tr>
    <td></td>
    <td>Collude</td>
    <td>Compete</td>
  </tr>
  <tr>
    <td>Collude</td>
    <td>(b,b)</td>
    <td>(d,a)</td>
  </tr>
  <tr>
    <td>Compete</td>
    <td>(a,d)</td>
    <td>(c,c)</td>
  </tr>
</table><br>

<p>In a simple one period setting, collusion does not constitute a Nash equilibrium and rational firms will therefore never collude under perfect information. Two firms will only collude if the cartel internal incentive constraint is not violated, that is if the (expected) profits of collusion are higher than the (expected) profits of defection, col def π ≥π . By assumption the incentive constraint is violated in the one shot game: the defection profit in the one shot case, a, is larger than b representing profits under collusion. Hence, firms will fall back to the unilateral output or price levels and the competitive equilibrium emerges. Introducing time into the game, i.e. periods are indexed by t ∈{0,1,2,...,T}, other outcomes may become equilibrium outcomes.
  One possibility is to transform the one shot game into a super game by infinitely repeating the stage game depicted in Table 1 (Formally T →∞ ). In the simplest scenario without discounting of future payoffs, the folk theorem applies, indicating that an infinite number of strategies can be supported as equilibria.4 Introducing a discount factor, δ ∈(0,1) , collusion remains a sustainable strategy if firms find it more profitable. Formally, the incentive constraints are</p>
<img src="economic-framework/images/model-tecol-tool_clip_image002.gif" alt="" width="343" height="60">
<br>
<p>i.e. expected profits of collusion (left hand side of the inequality) are greater than expected profits of defection (right side of the inequality). In the absence of competition law enforcement, this incentive constraint describes the logic of cartel dynamics. Holding profits, i.e. market conditions, constant it is possible to solve for the critical discount factor for which the incentives to cooperate equals the incentives to defect, that is  </p>
<p><img src="economic-framework/images/model-tecol-tool_clip_image003.gif" alt="" width="223" height="69"></p>
<p>i.e. the future is relatively important, collusion is stable. Collusion is stable because the threat to revert to the one shot Nash equilibrium is credible and does not allow any firm to profitably deviate while the collusive outcome is more profitable for both firms.
  Although the duopoly scenario outlined above is rather basic and the models are more complicated with n firms, larger strategy spaces (i.e. more than a binary choice set) or uncertainty, game theory as such cannot be considered to be particularly helpful for the empirical problem of cartel detection. It allows identifying the possibly infinite amount of collusive equilibria.
  As a result, economic theory can help to distinguish between competitive and collusive
  equilibria and provide some general considerations under what conditions collusion is more likely to arise.</p>
                </section>
                            
           <?php
include 'footer.php';
?>