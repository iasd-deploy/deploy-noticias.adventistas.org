<?php

// Protocol Buffers - Google's data interchange format
// Copyright 2008 Google Inc.  All rights reserved.
//
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file or at
// https://developers.google.com/open-source/licenses/bsd
namespace DeliciousBrains\WP_Offload_Media\Gcp\Google\Protobuf\Internal;

class RawInputStream
{
    private $buffer;
    public function __construct($buffer)
    {
        $this->buffer = $buffer;
    }
    public function getData()
    {
        return $this->buffer;
    }
}
