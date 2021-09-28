<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* result.html.twig */
class __TwigTemplate_0889ab8c2f462a698d3efeff5e5e3064f7d4c8cb1c629c126b75461dfef4c893 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "result.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "result.html.twig"));

        // line 1
        echo "<table width=\"100%\">
    <tr>
        <td width=\"20%\" valign=\"top\">
            <p>Shopify product</p>
            <textarea style=\"border:none\" name=\"\" id=\"myTextarea\" cols=\"70\" rows=\"200\">";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["shopify_product"]) || array_key_exists("shopify_product", $context) ? $context["shopify_product"] : (function () { throw new RuntimeError('Variable "shopify_product" does not exist.', 5, $this->source); })()), "html", null, true);
        echo "</textarea>
        </td>
        <td width=\"20%\">
            <p>Get Akeneo Attributes</p>
            <textarea style=\"border:none; border-left: #ccc 1px solid; padding-left: 20px\" name=\"\" id=\"myTextarea\" cols=\"70\" rows=\"30\">";
        // line 9
        echo twig_escape_filter($this->env, (isset($context["akeneo_attributes"]) || array_key_exists("akeneo_attributes", $context) ? $context["akeneo_attributes"] : (function () { throw new RuntimeError('Variable "akeneo_attributes" does not exist.', 9, $this->source); })()), "html", null, true);
        echo "</textarea>

            <p>Get Family Obj </p>
            <textarea style=\"border:none; border-left: #ccc 1px solid; padding-left: 20px\" name=\"\" id=\"myTextarea\" cols=\"70\" rows=\"30\">";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["akeneo_family"]) || array_key_exists("akeneo_family", $context) ? $context["akeneo_family"] : (function () { throw new RuntimeError('Variable "akeneo_family" does not exist.', 12, $this->source); })()), "html", null, true);
        echo "</textarea>
            <hr>
            <p>Get Family Variants Obj </p>
            <textarea style=\"border:none; border-left: #ccc 1px solid; padding-left: 20px\" name=\"\" id=\"myTextarea\" cols=\"70\" rows=\"200\"> ";
        // line 15
        echo twig_escape_filter($this->env, (isset($context["akeneo_family_variants"]) || array_key_exists("akeneo_family_variants", $context) ? $context["akeneo_family_variants"] : (function () { throw new RuntimeError('Variable "akeneo_family_variants" does not exist.', 15, $this->source); })()), "html", null, true);
        echo "</textarea>
        </td>
        <td width=\"20%\" valign=\"top\">
            <p>Simple Shopify Product</p>
            <textarea style=\"border:none\" name=\"\" id=\"myTextarea\" cols=\"70\" rows=\"200\">";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["shopify_simple_product"]) || array_key_exists("shopify_simple_product", $context) ? $context["shopify_simple_product"] : (function () { throw new RuntimeError('Variable "shopify_simple_product" does not exist.', 19, $this->source); })()), "html", null, true);
        echo "</textarea>
        </td>
        <td width=\"20%\" valign=\"top\">
            <p>Final Akeneo Products [";
        // line 22
        echo twig_escape_filter($this->env, (isset($context["akeneo_total_final_products"]) || array_key_exists("akeneo_total_final_products", $context) ? $context["akeneo_total_final_products"] : (function () { throw new RuntimeError('Variable "akeneo_total_final_products" does not exist.', 22, $this->source); })()), "html", null, true);
        echo "]</p>
            <textarea style=\"border:none\" name=\"\" id=\"myTextarea\" cols=\"70\" rows=\"200\">
                ";
        // line 24
        echo twig_escape_filter($this->env, (isset($context["akeneo_final_products"]) || array_key_exists("akeneo_final_products", $context) ? $context["akeneo_final_products"] : (function () { throw new RuntimeError('Variable "akeneo_final_products" does not exist.', 24, $this->source); })()), "html", null, true);
        echo "
                ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["akeneo_final_products"]) || array_key_exists("akeneo_final_products", $context) ? $context["akeneo_final_products"] : (function () { throw new RuntimeError('Variable "akeneo_final_products" does not exist.', 25, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 26
            echo "                ";
            echo twig_escape_filter($this->env, $context["product"], "html", null, true);
            echo "
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "            </textarea>
        </td>
    </tr>
</table>

<script>
    const ele = document.getElementsByTagName('textarea');

    for (let i = 0; i <= ele.length - 1; i++) {
        var badJSON = ele[i].value;
        var parseJSON = JSON.parse(badJSON);
        var JSONInPrettyFormat = JSON.stringify(parseJSON, undefined, 4);
        ele[i].value = JSONInPrettyFormat;
    }


</script>
* when doing data mapping is it better to clean the existing attributes and create our owns from scratch to match Shopify
<style>
    p {
        background: #5eb5e0;
    }
</style>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "result.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  103 => 28,  94 => 26,  90 => 25,  86 => 24,  81 => 22,  75 => 19,  68 => 15,  62 => 12,  56 => 9,  49 => 5,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<table width=\"100%\">
    <tr>
        <td width=\"20%\" valign=\"top\">
            <p>Shopify product</p>
            <textarea style=\"border:none\" name=\"\" id=\"myTextarea\" cols=\"70\" rows=\"200\">{{ shopify_product }}</textarea>
        </td>
        <td width=\"20%\">
            <p>Get Akeneo Attributes</p>
            <textarea style=\"border:none; border-left: #ccc 1px solid; padding-left: 20px\" name=\"\" id=\"myTextarea\" cols=\"70\" rows=\"30\">{{ akeneo_attributes  }}</textarea>

            <p>Get Family Obj </p>
            <textarea style=\"border:none; border-left: #ccc 1px solid; padding-left: 20px\" name=\"\" id=\"myTextarea\" cols=\"70\" rows=\"30\">{{ akeneo_family }}</textarea>
            <hr>
            <p>Get Family Variants Obj </p>
            <textarea style=\"border:none; border-left: #ccc 1px solid; padding-left: 20px\" name=\"\" id=\"myTextarea\" cols=\"70\" rows=\"200\"> {{ akeneo_family_variants }}</textarea>
        </td>
        <td width=\"20%\" valign=\"top\">
            <p>Simple Shopify Product</p>
            <textarea style=\"border:none\" name=\"\" id=\"myTextarea\" cols=\"70\" rows=\"200\">{{ shopify_simple_product }}</textarea>
        </td>
        <td width=\"20%\" valign=\"top\">
            <p>Final Akeneo Products [{{ akeneo_total_final_products }}]</p>
            <textarea style=\"border:none\" name=\"\" id=\"myTextarea\" cols=\"70\" rows=\"200\">
                {{ akeneo_final_products }}
                {% for product in akeneo_final_products  %}
                {{ product }}
                {% endfor %}
            </textarea>
        </td>
    </tr>
</table>

<script>
    const ele = document.getElementsByTagName('textarea');

    for (let i = 0; i <= ele.length - 1; i++) {
        var badJSON = ele[i].value;
        var parseJSON = JSON.parse(badJSON);
        var JSONInPrettyFormat = JSON.stringify(parseJSON, undefined, 4);
        ele[i].value = JSONInPrettyFormat;
    }


</script>
* when doing data mapping is it better to clean the existing attributes and create our owns from scratch to match Shopify
<style>
    p {
        background: #5eb5e0;
    }
</style>
", "result.html.twig", "/Users/salamdawod/Workspace/syapp/templates/result.html.twig");
    }
}
