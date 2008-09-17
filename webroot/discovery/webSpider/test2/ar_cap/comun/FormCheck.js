
var defaultEmptyOK = false
var checkNiceness = true;
var digits = "0123456789";
var lowercaseLetters = "abcdefghijklmnopqrstuvwxyzáéíóúñü"
var uppercaseLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚÑ"
var whitespace = " \t\n\r";
var phoneChars = "()-+ ";
var mMessage = "Error: No puede dejar campos vacios."
var pPrompt = "Error: ";
var pAlphanumeric = "Ingrese un texto que contenga sólo letras y/o números.";
var pAlphabetic   = "Ingrese un texto que contenga sólo letras.";
var pInteger = "Ingrese un número entero.";
var pNumber = "Debe ingresar un valor numérico.";
var pPhoneNumber = "Ingrese un número de teléfono.";
var pEmail = "Ingrese una dirección de correo electrónico válida.";
var pName = "Ingrese un texto que contenga sólo letras, números o espacios.";
var pNice = "No puede utilizar comillas aquí.";

function makeArray(n) {
   for (var i = 1; i <= n; i++) {
      this[i] = 0
   } 
   return this
}

function isEmpty(s)
{   return ((s == null) || (s.length == 0))
}

function isWhitespace (s)
{   var i;
    if (isEmpty(s)) return true;
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        // si el caracter en que estoy no aparece en whitespace,
        // entonces retornar falso
        if (whitespace.indexOf(c) == -1) return false;
    }
    return true;
}


function stripCharsInBag (s, bag)
{   var i;
    var returnString = "";

    // Buscar por el string, si el caracter no esta en "bag", 
    // agregarlo a returnString
    
    for (i = 0; i < s.length; i++)
    {   var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }

    return returnString;
}


function stripCharsNotInBag (s, bag)
{   var i;
    var returnString = "";
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (bag.indexOf(c) != -1) returnString += c;
    }

    return returnString;
}


function stripWhitespace (s)
{   return stripCharsInBag (s, whitespace)
}

function charInString (c, s)
{   for (i = 0; i < s.length; i++)
    {   if (s.charAt(i) == c) return true;
    }
    return false
}

function stripInitialWhitespace (s)
{   var i = 0;
    while ((i < s.length) && charInString (s.charAt(i), whitespace))
       i++;
    return s.substring (i, s.length);
}

function isLetter (c)
{
    return( ( uppercaseLetters.indexOf( c ) != -1 ) ||
            ( lowercaseLetters.indexOf( c ) != -1 ) )
}

function isDigit (c)
{   return ((c >= "0") && (c <= "9"))
}

function isLetterOrDigit (c)
{   return (isLetter(c) || isDigit(c))
}

function isInteger (s)
{   var i;
    if (isEmpty(s)) 
       if (isInteger.arguments.length == 1) return defaultEmptyOK;
       else return (isInteger.arguments[1] == true);
    
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if( i != 0 ) {
            if (!isDigit(c)) return false;
        } else { 
            if (!isDigit(c) && (c != "-") || (c == "+")) return false;
        }
    }
    return true;
}


function isNumber (s)
{   var i;
    var dotAppeared;
    dotAppeared = false;
    if (isEmpty(s)) 
       if (isNumber.arguments.length == 1) return defaultEmptyOK;
       else return (isNumber.arguments[1] == true);
    
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if( i != 0 ) {
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else     
                if (!isDigit(c)) return false;
        } else { 
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else     
                if (!isDigit(c) && (c != "-") || (c == "+")) return false;
        }
    }
    return true;
}

function isAlphabetic (s)
{   var i;

    if (isEmpty(s)) 
       if (isAlphabetic.arguments.length == 1) return defaultEmptyOK;
       else return (isAlphabetic.arguments[1] == true);
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is letter.
        var c = s.charAt(i);

        if (!isLetter(c))
        return false;
    }
    return true;
}

function isAlphanumeric (s)
{   var i;

    if (isEmpty(s)) 
       if (isAlphanumeric.arguments.length == 1) return defaultEmptyOK;
       else return (isAlphanumeric.arguments[1] == true);

    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (! (isLetter(c) || isDigit(c) ) )
        return false;
    }

    return true;
}


function isName (s)
{
    if (isEmpty(s)) 
       if (isName.arguments.length == 1) return defaultEmptyOK;
       else return (isAlphanumeric.arguments[1] == true);
    
    return( isAlphanumeric( stripCharsInBag( s, whitespace ) ) );
}

function isPhoneNumber (s)
{   var modString;
    if (isEmpty(s)) 
       if (isPhoneNumber.arguments.length == 1) return defaultEmptyOK;
       else return (isPhoneNumber.arguments[1] == true);
    modString = stripCharsInBag( s, phoneChars );
    return (isInteger(modString))
}

function isEmail (s)
{
    if (isEmpty(s)) 
       if (isEmail.arguments.length == 1) return defaultEmptyOK;
       else return (isEmail.arguments[1] == true);
    if (isWhitespace(s)) return false;
    var i = 1;
    var sLength = s.length;
    while ((i < sLength) && (s.charAt(i) != "@"))
    { i++
    }

    if ((i >= sLength) || (s.charAt(i) != "@")) return false;
    else i += 2;

    while ((i < sLength) && (s.charAt(i) != "."))
    { i++
    }

    if ((i >= sLength - 1) || (s.charAt(i) != ".")) return false;
    else return true;
}

function isNice(s)
{
        var i = 1;
        var sLength = s.length;
        var b = 1;
        while(i<sLength) {
                if( (s.charAt(i) == "\"") || (s.charAt(i) == "'" ) ) b = 0;
                i++;
        }
        return b;
}

function statBar (s)
{   window.status = s
}

function warnEmpty (theField)
{   theField.focus()
    alert(mMessage)
    statBar(mMessage)
    return false
}

function warnInvalid (theField, s)
{   theField.focus()
    theField.select()
    alert(s)
    statBar(pPrompt + s)
    return false
}


function checkField (theField, theFunction, emptyOK, s)
{   
    var msg;
    if (checkField.arguments.length < 3) emptyOK = defaultEmptyOK;
    if (checkField.arguments.length == 4) {
        msg = s;
    } else {
        if( theFunction == isAlphabetic ) msg = pAlphabetic;
        if( theFunction == isAlphanumeric ) msg = pAlphanumeric;
        if( theFunction == isInteger ) msg = pInteger;
        if( theFunction == isNumber ) msg = pNumber;
        if( theFunction == isEmail ) msg = pEmail;
        if( theFunction == isPhoneNumber ) msg = pPhoneNumber;
        if( theFunction == isName ) msg = pName;
    }
    
    if ((emptyOK == true) && (isEmpty(theField.value))) return false;

    if ((emptyOK == false) && (isEmpty(theField.value))) 
        return warnEmpty(theField);

    if ( checkNiceness && !isNice(theField.value))
        return warnInvalid(theField, pNice);

    if (theFunction(theField.value) == true) 
        return true;
    else
        return warnInvalid(theField,msg);

}


